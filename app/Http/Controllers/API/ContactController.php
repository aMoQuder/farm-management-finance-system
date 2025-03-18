<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ContactResourse;
use App\Model\Contact;
use Illuminate\Http\Request;



class ContactController extends Controller
{   ///////////////////// Get All Contacts ///////////////////////
    public function index(): JsonResponse
    {
        $Contacts = ContactResourse::collection (Contact::all());
        return response()->json([
            'success' => true,
            'message' => 'Contacts retrieved successfully',
            'data' => $Contacts
        ], 200);
    }



    ///////////////////// Store Contact ///////////////////////
    public function store(Request $request): JsonResponse
    {
        $validatedData = validator( $request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|min:3|max:200',
            'message' => 'required|min:7|max:254',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
            'email.email'=>'خطاء في الايميل',
            'email.required'=>'مطلوووووووووووووووووووووب',
            'subject.required'=>'مطلوووووووووووووووووووووب',
            'message.required'=>'مطلوووووووووووووووووووووب',
        ]  );
        if ( $validatedData->fails() ) {
            $data = [
                'msg' => 'validation required',
                'status' => 0,
                'data' => $validatedData->errors()
            ];

            return response()->json( $data );
        }
        $Contact = Contact::create([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contact created successfully',
            'data' => $Contact
        ], 201);
    }

    ///////////////////// Show Single Contact ///////////////////////
    public function show($id): JsonResponse
    {
        $Contact = Contact::find($id);

        if (!$Contact) {
            return response()->json(['success' => false, 'message' => 'Contact not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Contact retrieved successfully',
            'data'=>new ContactResourse( $Contact ),
        ], 200);
    }

    ///////////////////// Update Contact ///////////////////////
    public function update(Request $request, $id): JsonResponse
    {
        $Contact = Contact::find($id);

        if (!$Contact) {
            return response()->json(['success' => false, 'message' => 'Contact not found'], 404);
        }

        $validatedData = validator( $request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|min:3|max:200',
            'message' => 'required|min:7|max:254',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
            'email.email'=>'خطاء في الايميل',
            'email.required'=>'مطلوووووووووووووووووووووب',
            'subject.required'=>'مطلوووووووووووووووووووووب',
            'message.required'=>'مطلوووووووووووووووووووووب',
        ]  );
        if ( $validatedData->fails() ) {
            $data = [
                'msg' => 'validation required',
                'status' => 0,
                'data' => $validatedData->errors()
            ];

            return response()->json( $data );
        }
        $Contact->update([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message,
        ]);



        return response()->json([
            'success' => true,
            'message' => 'Contact updated successfully',
            'data'=>new ContactResourse( $Contact ),
        ], 200);
    }

    ///////////////////// Delete Contact ///////////////////////
    public function destroy($id): JsonResponse
    {
        $Contact = Contact::find($id);

        if (!$Contact) {
            return response()->json(['success' => false, 'message' => 'Contact not found'], 404);
        }
        $Contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully',
            'data'=>new ContactResourse( $Contact ),
        ], 200);
    }
}

