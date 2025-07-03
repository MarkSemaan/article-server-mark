<?php

require(__DIR__ . "/category_seeder.php");
require(__DIR__ . "/article_seeder.php");

echo "Seeding database...";
(new CategorySeeder())->run();
(new ArticleSeeder())->run();
echo "Database seeded successfully";
