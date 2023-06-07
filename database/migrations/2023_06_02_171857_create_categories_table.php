<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    // SQL query to add courses + categories
    // (1, 'Administratie en onthaal'),
    // (2, 'Beauty en wellness'),
    // (3, 'Bouw'),
    // (4, 'Dieren'),
    // (5, 'Drones'),
    // (6, 'Elektro en techniek'),
    // (7, 'Energie en HVAC'),
    // (8, 'Financiën'),
    // (9, 'Grafische en multimedia'),
    // (10, 'Groenvoorziening'),
    // (11, 'Horeca en voeding'),
    // (12, 'Informatica'),
    // (13, 'Interieur en ontwerpen'),
    // (14, 'Kunst, antiek en creatief design'),
    // (15, 'Management'),
    // (16, 'Mode en kledij'),
    // (17, 'Safety'),
    // (18, 'Sales, marketing en communicatie'),
    // (19, 'Sport'),
    // (20, 'Starten met ondernemen'),
    // (21, 'Talen en redactie'),
    // (22, 'Toerisme'),
    // (23, 'Transport en logistiek'),
    // (24, 'Vastgoed'),
    // (25, 'Voertuigen en metaal'),
    // (26, 'Zorgverlening');

    // INSERT INTO courses (name, category_id) VALUES
    // ('Administratie en onthaal voor beginners', 1),
    // ('Administratie en onthaal voor gevorderden', 1),
    // ('Administratie en onthaal expertklasse', 1),
    // ('Beauty en wellness voor beginners', 2),
    // ('Beauty en wellness voor gevorderden', 2),
    // ('Beauty en wellness expertklasse', 2),
    // ('Bouw voor beginners', 3),
    // ('Bouw voor gevorderden', 3),
    // ('Bouw expertklasse', 3),
    // ('Dierenverzorging voor beginners', 4),
    // ('Dierenverzorging voor gevorderden', 4),
    // ('Dierenverzorging expertklasse', 4),
    // ('Drones voor beginners', 5),
    // ('Drones voor gevorderden', 5),
    // ('Drones expertklasse', 5),
    // ('Elektro en techniek voor beginners', 6),
    // ('Elektro en techniek voor gevorderden', 6),
    // ('Elektro en techniek expertklasse', 6),
    // ('Energie en HVAC voor beginners', 7),
    // ('Energie en HVAC voor gevorderden', 7),
    // ('Energie en HVAC expertklasse', 7),
    // ('Financiën voor beginners', 8),
    // ('Financiën voor gevorderden', 8),
    // ('Financiën expertklasse', 8),
    // ('Grafische en multimedia voor beginners', 9),
    // ('Grafische en multimedia voor gevorderden', 9),
    // ('Grafische en multimedia expertklasse', 9),
    // ('Groenvoorziening voor beginners', 10),
    // ('Groenvoorziening voor gevorderden', 10),
    // ('Groenvoorziening expertklasse', 10),
    // ('Horeca en voeding voor beginners', 11),
    // ('Horeca en voeding voor gevorderden', 11),
    // ('Horeca en voeding expertklasse', 11),
    // ('Informatica voor beginners', 12),
    // ('Informatica voor gevorderden', 12),
    // ('Informatica expertklasse', 12),
    // ('Interieur en ontwerpen voor beginners', 13),
    // ('Interieur en ontwerpen voor gevorderden', 13),
    // ('Interieur en ontwerpen expertklasse', 13),
    // ('Kunst, antiek en creatief design voor beginners', 14),
    // ('Kunst, antiek en creatief design voor gevorderden', 14),
    // ('Kunst, antiek en creatief design expertklasse', 14),
    // ('Management voor beginners', 15),
    // ('Management voor gevorderden', 15),
    // ('Management expertklasse', 15),
    // ('Mode en kledij voor beginners', 16),
    // ('Mode en kledij voor gevorderden', 16),
    // ('Mode en kledij expertklasse', 16),
    // ('Safety voor beginners', 17),
    // ('Safety voor gevorderden', 17),
    // ('Safety expertklasse', 17),
    // ('Sales, marketing en communicatie voor beginners', 18),
    // ('Sales, marketing en communicatie voor gevorderden', 18),
    // ('Sales, marketing en communicatie expertklasse', 18),
    // ('Sport voor beginners', 19),
    // ('Sport voor gevorderden', 19),
    // ('Sport expertklasse', 19),
    // ('Starten met ondernemen voor beginners', 20),
    // ('Starten met ondernemen voor gevorderden', 20),
    // ('Starten met ondernemen expertklasse', 20),
    // ('Talen en redactie voor beginners', 21),
    // ('Talen en redactie voor gevorderden', 21),
    // ('Talen en redactie expertklasse', 21),
    // ('Toerisme voor beginners', 22),
    // ('Toerisme voor gevorderden', 22),
    // ('Toerisme expertklasse', 22),
    // ('Transport en logistiek voor beginners', 23),
    // ('Transport en logistiek voor gevorderden', 23),
    // ('Transport en logistiek expertklasse', 23),
    // ('Vastgoed voor beginners', 24),
    // ('Vastgoed voor gevorderden', 24),
    // ('Vastgoed expertklasse', 24),
    // ('Voertuigen en metaal voor beginners', 25),
    // ('Voertuigen en metaal voor gevorderden', 25),
    // ('Voertuigen en metaal expertklasse', 25),
    // ('Zorgverlening voor beginners', 26),
    // ('Zorgverlening voor gevorderden', 26),
    // ('Zorgverlening expertklasse', 26);

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('categories', function (Blueprint $table) {
        //     $table->dropForeign(['course_id']);
        // });
        Schema::dropIfExists('categories');
    }
};