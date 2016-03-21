<?php

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Label;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
        	'name' => 'Clay Malven',
        	'email' => 'claycpi@gmail.com',
        	'phone' => '210-482-9439',
        	'birthday' => '1980-05-18',
        ]);

        $labels = [1 => 'Family', 2 => 'Friend', 3 => 'Work', 4 => 'Private'];
        foreach ($labels as $key => $label) {
	        Label::create([
	        	'name' => $label,
	        ]);
	        DB::table('label_user')->insert([
            	'label_id' => $key,
            	'user_id' => 1,
        	]);
        }



        DB::table('contact_user')->insert([
            'contact_id' => 1,
            'user_id' => 1,
        ]);

        DB::table('contact_label')->insert([
            'contact_id' => 1,
            'label_id' => 1,
        ]);

	    factory(Contact::class, 10)->create()->each(function($contact) {
	        DB::table('contact_user')->insert([
            	'contact_id' => $contact->id,
            	'user_id' => 1,
        	]);

            DB::table('contact_label')->insert([
            	'contact_id' => $contact->id,
            	'label_id' => rand(1, 4),
        	]);
	    });

    }
}
