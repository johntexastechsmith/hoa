<?php
namespace App\Http\Controllers;

use App\Integrations\QuickBooks;

class QuickBooksController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $quickBooks = new QuickBooks();

        $customer = $quickBooks->createCustomer([
            "BillAddr" => [
                "Line1" => "123 Main Street",
                "City" =>  "Mountain View",
                "Country" =>  "USA",
                "CountrySubDivisionCode" =>  "CA",
                "PostalCode" =>  "94042"
            ],
            "Notes" =>  "Here are other details.",
            "Title" =>  "Mr",
            "GivenName" =>  "John",
            "MiddleName" =>  "A",
            "FamilyName" =>  "Smith",
            "Suffix" =>  "Jr",
            "FullyQualifiedName" =>  "John A Smith",
            "CompanyName" =>  "",
            "DisplayName" =>  "John A Smith",
            "PrimaryPhone" =>  [
                "FreeFormNumber" =>  "(444) 444-4444"
            ],
            "PrimaryEmailAddr" => [
                "Address" => "johnA@myemail.com"
            ],
            "AcctNum" => 'ABCD'
        ]);
        dd($customer);

        dd($quickBooks->allCustomers());
        echo "All Done!";
    }
}