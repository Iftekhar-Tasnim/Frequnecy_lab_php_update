<?php
require_once 'config/db.php';

// Create Table
try {
    $sql = file_get_contents(__DIR__ . '/sql/create_publications_table.sql');
    $pdo->exec($sql);
    echo "Table 'publications' created/checked successfully.\n";
} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage() . "\n");
}

// Seed Data
$publications = [
    // Profiles
    [
        'type' => 'profile',
        'title' => 'IEEE Author Profile',
        'link' => 'https://ieeexplore.ieee.org/author/37087127618',
        'year' => null
    ],
    [
        'type' => 'profile',
        'title' => 'Tahmidul Kabir – Extracurricular Activities Profile',
        'link' => 'https://sites.google.com/view/tahmidul-kabir/extracurricular-activities?authuser=0',
        'year' => null
    ],
    // Journals
    [
        'type' => 'journal',
        'title' => 'Asian Journal of Contemporary Technology – Article 1',
        'link' => 'https://www.asianssr.org/index.php/ajct/article/view/1143',
        'year' => null
    ],
    [
        'type' => 'journal',
        'title' => 'Asian Journal of Contemporary Technology – Article 2',
        'link' => 'https://www.asianssr.org/index.php/ajct/article/view/1144',
        'year' => null
    ],
    [
        'type' => 'journal',
        'title' => 'International Journal of Informatics and Communication Technology (IJICT)',
        'link' => 'https://ijict.iaescore.com/index.php/IJICT/article/view/20404',
        'year' => null
    ],
    [
        'type' => 'journal',
        'title' => 'International Journal of Reconfigurable and Embedded Systems (IJRES)',
        'link' => 'https://ijres.iaescore.com/index.php/IJRES/article/view/20545',
        'year' => null
    ],
    [
        'type' => 'journal',
        'title' => 'International Journal of Electrical and Computer Engineering (IJEECS)',
        'link' => 'https://ijeecs.iaescore.com/index.php/IJEECS/article/view/29384',
        'year' => null
    ],
    [
        'type' => 'journal',
        'title' => 'International Journal of Public Health Science (IJPHS)',
        'link' => 'https://ijphs.iaescore.com/index.php/IJPHS/article/view/22577',
        'year' => null
    ],
    // Papers/Articles
    [
        'type' => 'article',
        'title' => 'A deep learning and machine learning approach to predict neonatal death in the context of São Paulo',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => 2024
    ],
    [
        'type' => 'article',
        'title' => 'An intelligent wind turbine with yaw mechanism using machine learning to reduce high-cost sensors quantity',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => 2023
    ],
    [
        'type' => 'article',
        'title' => 'Smart vehicle management by using sensors and an IoT based black box',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => null
    ],
    [
        'type' => 'article',
        'title' => 'Smart vehicle management system for accident reduction by using sensors and an IoT based black box',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => 2021
    ],
    [
        'type' => 'article',
        'title' => 'A review on notification sending methods to the recipients in different technology-based women safety solutions',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => 2022
    ],
    [
        'type' => 'article',
        'title' => 'An IoT Based Intelligent Parking System for the Unutilized Parking Area With Real-Time Monitoring Using Mobile and Web Application',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => 2021
    ],
    [
        'type' => 'article',
        'title' => 'Data Augmentation Technique to Expand Road Dataset Using Mask RCNN and Image Inpainting',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => 2021
    ],
    [
        'type' => 'article',
        'title' => 'IoT Based Smart Home Automation and Security System Using Mobile App With Assistant Robot for Developing Countries',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => 2021
    ],
    [
        'type' => 'article',
        'title' => 'A Comprehensive Smart IoT Tracker for the Children, Elder, and Luggage With the Assistance of Mobile App',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => 2020
    ],
    [
        'type' => 'article',
        'title' => 'Safety Solution for Women Using Smart Band and CWS App',
        'link' => 'https://www.researchgate.net/publication/342887095_Safety_Solution_for_Women_Using_Smart_Band_and_CWS_App',
        'year' => 2020
    ],
    [
        'type' => 'article',
        'title' => 'IoT Based Low Cost Smart Indoor Farming Management System Using an Assistant Robot and Mobile App',
        'link' => 'https://www.researchgate.net/profile/A-Z-M-Kabir',
        'year' => 2020
    ],
    [
        'type' => 'article',
        'title' => 'Automated Parking System with Fee Management Using Arduino',
        'link' => 'https://aiub.academia.edu/AZMTahmidulKabir',
        'year' => 2019
    ],
    [
        'type' => 'article',
        'title' => 'Six Tier Multipurpose Security Locker System Based on Arduino',
        'link' => 'https://aiub.academia.edu/AZMTahmidulKabir',
        'year' => 2019
    ],
    [
        'type' => 'article',
        'title' => 'An Intelligent Street Light System Based on Piezoelectricity Generator with Noticeable Zebra Crossing Point and Bus Stand',
        'link' => 'https://aiub.academia.edu/AZMTahmidulKabir',
        'year' => 2019
    ],
    [
        'type' => 'article',
        'title' => 'Intelligent Path-Finder for The Blind',
        'link' => 'https://aiub.academia.edu/AZMTahmidulKabir',
        'year' => 2019
    ]
];

$stmt = $pdo->prepare("INSERT INTO publications (type, title, link, publication_date, is_featured) VALUES (?, ?, ?, ?, ?)");

foreach ($publications as $pub) {
    // Check if duplicate
    $checkStats = $pdo->prepare("SELECT id FROM publications WHERE title = ?");
    $checkStats->execute([$pub['title']]);
    
    if ($checkStats->rowCount() > 0) {
        echo "Skipping duplicate: " . $pub['title'] . "\n";
        continue;
    }

    $date = $pub['year'] ? $pub['year'] . '-01-01' : null; // Approximate date
    $is_featured = ($pub['type'] == 'profile') ? 1 : 0; // Feature profiles by default
    
    try {
        $stmt->execute([$pub['type'], $pub['title'], $pub['link'], $date, $is_featured]);
        echo "Inserted: " . $pub['title'] . "\n";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}

echo "Migration complete.\n";
