<?php
require_once 'ContactManager.php';
require_once 'Contact.php';
class Command
{


    /**
     * Displays help information for various commands.
     *
     * This method provides descriptions and usage information for the following commands:
     * - help: Displays this help information.
     * - list: Lists all contacts.
     * - detail [id]: Shows the details of a contact with the specified ID.
     * - create [name], [email], [phone_number]: Creates a new contact with the provided name, email, and phone number.
     * - delete [id]: Deletes the contact with the specified ID.
     * - modify [id], [name], [email], [phone_number]: Modifies the contact with the specified ID and updates it with the provided name, email, and phone number.
     * - quit: Exits the program.
     *
     * @return void
     */
    public function help(){
        echo "\nhelp : affiche cette aide\n\n";
        echo "list : liste les contacts\n\n";
        echo "detail [id] : affiche les informations d'un contact\n\n";
        echo "create [name], [email], [phone_number], : crée un contact\n\n";
        echo "delete [id] : supprime un contact\n\n";
        echo "modify [id], [name], [email], [phone_number] : modifie un contact\n\n";
        echo "quit : quitte le programme\n\n";
    }


    /**
     * Lists all contacts and displays their details.
     *
     * This method retrieves all contacts from the ContactManager,
     * and outputs their ID, name, email, and phone number.
     *
     * @return void
     */
    public function list(){
        echo "\nListe des contacts :\n\n";
        echo "id, name, email, phone number\n\n";
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        foreach ($contacts as $contact) {
            echo $contact->toString() . "\n\n";
        }
    }

    /**
     * Retrieves and displays the details of a contact based on the given ID.
     *
     * @param int $id The ID of the contact to retrieve.
     * @return void
     */
    public function detail($id){
        $contactManager = new ContactManager();
        $contacts = $contactManager->findById($id);
        echo "\n".$contacts->toString() . "\n\n";
    }

    /**
     * Creates a new contact with the provided name, email, and phone number.
     *
     * @param string $name The name of the contact to create.
     * @param string $email The email address of the contact to create.
     * @param string $phone_number The phone number of the contact to create.
     * @return void
     */
    public function create($name, $email, $phone_number){
        $contactManager = new ContactManager();
        $contactManager->createContact($name, $email, $phone_number);
    }

    /**
     * Deletes the contact based on the given ID.
     *
     * @param int $id The ID of the contact to delete.
     * @return void
     */
    public function delete($id){
        $contactManager = new ContactManager();
        $contactManager->deleteContact($id);
    }


    /**
     * Modify a contact's details by ID.
     *
     * @param int $id The unique identifier of the contact.
     * @param string $name The name of the contact.
     * @param string $email The email address of the contact.
     * @param string $phone_number The phone number of the contact.
     * @return void
     */
    public function modify($id, $name, $email, $phone_number){
        $contactManager = new ContactManager();
        $contactManager->modifyContact($id,$name,$email,$phone_number);
    }




}