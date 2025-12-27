<?php
require_once 'config/db.php';

$members = [
    // Board
    [
        'name' => 'Md. Golam Sarowar',
        'designation' => 'Founder & CEO',
        'category' => 'board',
        'bio' => 'Technology strategist and researcher in IoT & Robotics. Leading innovation in STEM education and smart technologies.',
        'image_path' => 'assets/team/Sarowar.JPG',
        'display_order' => 1
    ],
    // Advisors
    [
        'name' => 'Md. Shah Alam Monshi',
        'designation' => 'Strategy Advisor',
        'category' => 'advisor',
        'bio' => 'COO, Partex Furniture. Co-Chairman, FBCCI Standing Comm. Director, SBCCI.',
        'image_path' => 'assets/Advisor_Panel/Md.Shah Alam Monshi.jpg',
        'display_order' => 1
    ],
    [
        'name' => 'Major Shomen Kanti Barua (Retd.)',
        'designation' => 'Military Advisor',
        'category' => 'advisor',
        'bio' => 'Former Regiment Adjutant, Bangladesh National Cadet Corps.',
        'image_path' => 'assets/Advisor_Panel/Major Shomen Kanti Barua.jpg',
        'display_order' => 2
    ],
    // Executives
    [
        'name' => 'Sahanaz Sharmin',
        'designation' => 'Senior Coordinator',
        'category' => 'executive',
        'bio' => 'B.Sc. Undergraduate | CSE',
        'image_path' => 'assets/team/Shahnaz Sharmin.jpeg',
        'display_order' => 1
    ],
    [
        'name' => 'Samin Yaser Ayon',
        'designation' => 'STEM Coordinator',
        'category' => 'executive',
        'bio' => 'B.Sc. Undergraduate | CSE',
        'image_path' => 'assets/team/Ayon_STEM Coordinator (SCOPE PROJECT).jpg',
        'display_order' => 2
    ],
    [
        'name' => 'Iftekhar Tasnim Md. Asif',
        'designation' => 'STEM Facilitator',
        'category' => 'executive',
        'bio' => 'B.Sc. Undergraduate | CSE',
        'image_path' => 'assets/team/asif.png',
        'display_order' => 3
    ],
    [
        'name' => 'Tarikul Islam Juel',
        'designation' => 'STEM Facilitator',
        'category' => 'executive',
        'bio' => 'B.Sc. Undergraduate | CSE',
        'image_path' => 'assets/team/Tarikul Islam Juel (STEM Teacher).jpeg',
        'display_order' => 4
    ],
    [
        'name' => 'Istiak Ahmed',
        'designation' => 'STEM Facilitator',
        'category' => 'executive',
        'bio' => 'B.Sc. Undergraduate | CSE',
        'image_path' => 'assets/team/Istiak.jpg',
        'display_order' => 5
    ]
];

try {
    // Clear existing to avoid duplicates if re-run (optional, but good for dev)
    $pdo->exec("TRUNCATE TABLE team_members");

    $stmt = $pdo->prepare("INSERT INTO team_members (name, designation, category, bio, image_path, display_order) VALUES (?, ?, ?, ?, ?, ?)");

    foreach ($members as $m) {
        $stmt->execute([
            $m['name'],
            $m['designation'],
            $m['category'],
            $m['bio'],
            $m['image_path'],
            $m['display_order']
        ]);
    }

    echo "Successfully seeded " . count($members) . " team members.";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
