<?php


require_once 'DBConnect.php';

require_once 'Contact.php';

/**
 * Class ContactManager
 *
 * Manages contact records, providing functionalities for retrieving, creating,
 * and deleting contacts from the database.
 */
class ContactManager
{

    private PDO $db;


    /**
     * Constructor method to initialize the database connection.
     *
     * This method sets up the PDO instance for database interactions using
     * the singleton instance from the DBConnect class.
     *
     * @return void
     */
    public function __construct()
    {
        // On récupère l'instance de PDO
        $this->db = DBConnect::getInstance()->getPDO();
    }

    /**
     * Retrieves all contact records from the database and returns them as instances of the Contact class.
     *
     * @return array An array containing all contacts as instances of the Contact class.
     */
    public function findAll(): array
    {
        $query = $this->db->query('SELECT * FROM contact');
        $contactData = $query->fetchAll(PDO::FETCH_ASSOC);
        $contacts = [];
        foreach ($contactData as $data) {
            $contact = new Contact();
            $contact->setId($data['id']);
            $contact->setName($data['name']);
            $contact->setEmail($data['email']);
            $contact->setPhoneNumber($data['phone_number']);
            $contacts[] = $contact;
        }
        return $contacts; //Retourne ce tableau associatif contenant tous les contacts en tant qu'instances de la classe Contact.
    }

    /**
     * Retrieves a Contact object by its ID from the database.
     *
     * @param int $id The ID of the contact to retrieve.
     * @return Contact The Contact object associated with the given ID.
     */
    public function findById(int $id): Contact
    {
        $query = $this->db->prepare('SELECT * FROM contact WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $contactData = $query->fetch(PDO::FETCH_ASSOC);
        $contact = new Contact();
        $contact->setId($contactData['id']);
        $contact->setName($contactData['name']);
        $contact->setEmail($contactData['email']);
        $contact->setPhoneNumber($contactData['phone_number']);

        return $contact;
    }

    /**
     * Creates a new contact and inserts it into the database.
     *
     * @param string $name The name of the contact.
     * @param string $email The email address of the contact.
     * @param string $phone_number The phone number of the contact.
     * @return void
     */
    public function createContact(string $name, string $email, string $phone_number): void
    {
        $query = $this->db->prepare('INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)');
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
        $query->execute();
    }


    /**
     * Modifies the details of an existing contact in the database.
     *
     * @param int $id The ID of the contact to be modified.
     * @param string $name The new name of the contact.
     * @param string $email The new email address of the contact.
     * @param string $phone_number The new phone number of the contact.
     * @return void
     */
     public function modifyContact($id, $name, $email, $phone_number) :void {
        $query = $this->db->prepare('UPDATE contact SET name = :name, email = :email, phone_number = :phone_number WHERE id = :id');
        $query->bindValue(':id', $id);
        $query->bindValue(':name', $name);
        $query->bindValue(':email', $email);
        $query->bindValue(':phone_number', $phone_number);
        $query->execute();
     }

    /**
     * Deletes a contact from the database by its ID.
     *
     * @param int $id The ID of the contact to delete.
     * @return void
     */
    public function deleteContact($id) :void {
        $query = $this->db->prepare('DELETE FROM contact WHERE id = :id');
        $query->bindValue(':id', $id);
        $query->execute();
    }
}

