<?php

use Illuminate\Database\Seeder;

class Settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keywords = json_encode(['bootup']);
        DB::table('settings')->insert([
			['name'=>'title','value'=>'Bootup'],
			['name'=>'description','value'=>'Bootup'],
			['name'=>'keywords','value'=>$keywords],
			['name'=>'live','value'=>'0'],
			['name'=>'author','value'=>'Bootup'],
			['name'=>'recaptchakey','value'=>'6Le_zBQTAAAAAHPEWDzos16seZdgVrzFamee4Fav'],
			['name'=>'recaptchasecret','value'=>'6Le_zBQTAAAAAD2qx69wWbFUX8JKP_wH_qBmKquS'],
		]);
    }
}
