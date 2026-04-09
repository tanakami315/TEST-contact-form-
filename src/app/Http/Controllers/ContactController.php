<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index',compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email','address', 'building', 'detail', 'tel1', 'tel2', 'tel3' ]);
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        $category = Category::find($request->category_id);
        return view('confirm', compact('contact','category'));
    }

    public function store(Request $request)
    {
        $contact = $request->only([ 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail']);   
        Contact::create($contact);
        return view('thanks');
    }

    public function revise(ContactRequest $request)
    {
        return redirect('/')
            ->withInput();
    }


    public function search(Request $request)
    {
        $contacts = Contact::with('category')
            ->CategorySearch($request->category_id)
            ->KeywordSearch($request->keyword)
            ->GenderSearch($request->gender)
            ->DateSearch($request->created_at)
            ->paginate(7)
            ->appends($request->all());

        $categories = Category::all();

        return view('auth.admin', compact('contacts','categories'));
    }

    public function export (Request $request)
    {
        $contacts = Contact::with('category')
            ->CategorySearch($request->category_id)
            ->KeywordSearch($request->keyword)
            ->GenderSearch($request->gender)
            ->DateSearch($request->created_at)
            ->get();
        
        $csvHeader = ['お名前','性別','メールアドレス', 'お問い合わせの種類'];
        $csvData = $contacts->map(function ($contact) {
            return [
                $contact->last_name . $contact->first_name,
                $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                $contact->email,
                optional($contact->category)->content,
            ];
        });

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');

            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);

        return $response;
    }
}

