<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Contact::class;

    public function definition()
    {
        // $details = [
        //         '届いた商品が注文した商品ではありませんでした。商品の取り換えをお願いします。',
        //         '注文した商品がまだ届いていないのですが、現在の配送状況を教えていただけますか。',
        //         '商品に不具合がありましたので、交換対応をお願いしたいです。手続き方法を教えてください。',
        //         '注文内容を一部変更したいのですが、対応可能でしょうか。変更方法について教えてください。',
        //         '返品を希望していますが、どのような手順で進めればよいか詳しく教えてください。',
        //         '購入した商品の使い方が分からないため、簡単にご説明いただけると助かります。',
        //         '支払い方法を変更したいのですが、注文後でも変更可能か確認したいです。',
        //         '商品ページに記載されている内容について、もう少し詳しく教えていただけますか。',
        //         '同じ商品を複数購入したいのですが、在庫状況について教えてください。',
        //         '配送先の住所を変更したいのですが、現在の注文に対して変更は可能でしょうか。',
        //         '商品が破損した状態で届きました。今後の対応についてご案内をお願いいたします。'
        // ];

        // return [
        //     'last_name' => $this->faker->lastName(),
        //     'first_name' => $this->faker->firstName(),
        //     'gender' => $this->faker->numberBetween(1,3),
        //     'email' => $this->faker->safeEmail(),
        //     'tel' => $this->faker->numerify('090########'),
        //     'address' => $this->faker->streetAddress(),
        //     'building'=> $this->faker->optional()->secondaryAddress(),
        //     'category_id' => $this->faker->numberBetween(1,5),
        //     'detail' => $this->faker->randomElement($details),
        // ];

        $categoryId = $this->faker->numberBetween(1,5);

        $categoryDetails = [
            1 => [ // 商品のお届けについて
                '注文した商品がまだ届いておらず、発送状況について確認したくご連絡いたしました。現在どのような配送状況か教えていただけますでしょうか。',
                '先日注文した商品について、発送完了の連絡は受け取っているのですが、到着予定日が分からず困っております。おおよその到着時期を教えてください。',
                '配送先住所に誤りがあった可能性があり、商品が正しく届くか不安です。現在の配送状況と併せて確認していただけますでしょうか。'
            ],

            2 => [ // 商品の交換について
                '届いた商品が注文した商品ではありませんでした。商品の取り換えをお願いします。',
                'サイズ違いの商品が届いてしまい使用できないため、正しいサイズの商品と交換していただきたいです。必要な手続きを教えてください。',
                '注文した商品のカラーと届いた商品のカラーが違いました。'
            ],

            3 => [ // 商品トラブル
                '本日届いた商品を確認したところ、外装が破損しており中身にも影響があるように見受けられます。今後の対応についてご指示いただけますでしょうか。',
                '購入した商品を使用しようとしたところ、正常に動作しない状態でした。不具合の可能性があるため、対応方法についてご相談させてください。',
                '商品を開封した際に部品が不足していることに気づきました。この場合どのように対応していただけるのかご案内をお願いできますでしょうか。'
            ],
            4 => [ // ショップへのお問い合わせ
                '商品の仕様について確認したい点がありご連絡いたしました。掲載されている情報だけでは分からない部分があるため、詳細をご教示いただけますでしょうか。',
                '支払い方法の変更が可能かどうか確認したくお問い合わせいたしました。注文後でも変更できる場合の手続きについて教えていただきたいです。',
                '複数商品をまとめて購入した場合の送料や配送方法について詳しく知りたいです。条件や注意点があれば併せて教えてください。'
            ],
            5 => [ // その他
                'その他の問い合わせです。',
                '特に急ぎではないのですが確認したいです。',
            ],
        ];

        $gender = $this->faker->numberBetween(1,3);

        if ($gender === 1) {
            $firstName = $this->faker->firstNameMale();
            $lastName = $this->faker->lastName();
        } elseif ($gender === 2) {
            $firstName = $this->faker->firstNameFemale();
            $lastName = $this->faker->lastName();
        } else {
            $firstName = $this->faker->firstName();
            $lastName = $this->faker->lastName();
        }

        return [
            'category_id' => $categoryId,
            'detail' => $this->faker->randomElement($categoryDetails[$categoryId]),

            'gender' => $gender,
            'first_name' => $firstName,
            'last_name' => $lastName,

            'email' => $this->faker->safeEmail(),
            'tel' => $this->faker->numerify('090########'),
            'address' => $this->faker->address(),
            'building'=> $this->faker->optional()->secondaryAddress(),
        ];
        }
}
