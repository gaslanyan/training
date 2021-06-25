<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;
use Carbon\Carbon;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getData();
        foreach ($data as $index) {
            Facades\DB::table('messages')->insert($index);
        }
    }

    public function getData()
    {
        return [
            [
                "name" => "Մասնակցին հաստատելու հաղորդագրություն",
                "key" => "approved_user",
                "value" => "Մասնակցին հաստատելու հաղորդագրություն  Մասնակցին հաստատելու հաղորդագրություն Մասնակցին հաստատելու հաղորդագրություն",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name" => "Մասնակցին հեռացնելու հաղորդագրություն",
                "key" => "rejected_user",
                "value" => "Մասնակցին հեռացնելու հաղորդագրություն Մասնակցին հեռացնելու հաղորդագրություն Մասնակցին հեռացնելու հաղորդագրություն",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                 "name" => " Բարի գալուստ։",
                "key" => "registered_user",
                "value" => "Դուք գրանցվել եք ԲՈՒԺԱՇԽԱՏՈՂՆԵՐԻ ՇԱՐՈՒՆԱԿԱԿԱՆ ՄԱՍՆԱԳԻՏԱԿԱՆ ԶԱՐԳԱՑՄԱՆ էլեկտրոնային հարթակում։ Նշենք, որ այն իր տեսակով առաջինն է Հայաստանի Հանրապետությում։ Հարթակի միջոցով, դուք կարող եք հեռավար կերպով մասնակցել ՇՄԶ ծրագրերի և հավաքել ՇՄԶ կրեդիտներ։ <p> Նախագծի կառավարումն իրականացվում է ԱԶԳԱՅԻՆ ԲԺՇԿԱԿԱՆ ՊԱԼԱՏԻ աջակցությամբ։ </p>( https://www.facebook.com/national.medical.palace.armenia/?ref=pages_you_manage )",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name" => "Դասավանդում",
                "key" => "registered_lecture",
                "value" => "Դասավանդում, դասավանդում դասավանդում դասավանդումդասավանդումդասավանդում",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]
        ];
    }
}
