<?php

namespace App\Infrastructure\Persistence\ContactInfo;

use App\Domain\ContactInfo\ContactInfo;
use App\Domain\ContactInfo\ContactInfoRepository;
use DomainException;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Selective\Database\Connection;

final class ContactInfoReaderRepository implements ContactInfoRepository
{
    private Connection $connection;
    private PHPMailer $mail;
    private $tableName = "contact_info";
    private $columns = ['id', 'isRead', 'name', 'email', 'phone', 'query'];
    private string $orderBy = "id desc";

    public function __construct(Connection $connection, PHPMailer $mail)
    {
        $this->connection = $connection;
        $this->mail = $mail;
    }

    public function findAll(): array
    {
        $query = $this->connection->select()->from($this->tableName)->orderBy($this->orderBy);

        $query->columns($this->columns);

        $rows = $query->execute()->fetchAll() ?: [];

        if (!is_array($rows)) {
            throw new DomainException(sprintf('Contact Info not found'));
        }

        $contactInfos = [];

        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            $row = $rows[$iCounter];
            array_push($contactInfos, $this->convertData($row));
        }

        return $contactInfos;
    }

    /**
     * @throws Exception
     */
    public function create($d): ContactInfo
    {
        $d['id'] = null;
        $query = $this->connection->insert()->into($this->tableName)->set($d);
        $query->execute();

        $this->mail->isHTML(true);
        $this->mail->addAddress('panacheworldinterior@gmail.com', $d['name']);

        // Set email content
        $this->mail->Subject = 'New Contact Info ' . $d['name'];
        $this->mail->Body = 'Name - ' . $d['name'] . '<br/>';
        $this->mail->Body .= 'Email - ' . $d['email'] . '<br/>';
        $this->mail->Body .= 'Phone - ' . $d['phone'] . '<br/>';
        $this->mail->Body .= 'Query - ' . $d['query'];

        // Send the email
        $this->mail->send();

        return $this->findContactInfoById($query->lastInsertId());
    }

    private function findContactInfoById(int $id): ContactInfo
    {
        $query = $this->connection->select()->from($this->tableName);

        $query->columns($this->columns);
        $query->where('id', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Contact Info not found: %s', $id));
        }

        return $this->convertData($row);
    }

    public function deleteById(int $id)
    {
        $query = $this->connection->delete()->from($this->tableName)->where("id", "=", $id);

        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Contact Info not found: %s', $id));
        }

        return 'OK';
    }



    private function convertData($row): ContactInfo
    {
        return new ContactInfo($row['id'], $row['isRead'], $row['name'], $row['email'], $row['phone'], $row['query']);
    }
}
