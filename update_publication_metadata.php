<?php
require_once 'config/db.php';

// Metadata array (Simulated/Interpreted based on title/link)
$updates = [
    'IEEE Author Profile' => [
        'authors' => 'Tahmidul Kabir',
        'abstract' => 'Senior Member, IEEE. Researcher in IoT, Embedded Systems, and Machine Learning with a focus on sustainable solutions for developing countries.'
    ],
    'Tahmidul Kabir – Extracurricular Activities Profile' => [
        'authors' => 'Tahmidul Kabir',
        'abstract' => 'Showcase of extracurricular achievements, robotics competitions, and leadership roles in engineering communities.'
    ],
     'A deep learning and machine learning approach to predict neonatal death in the context of São Paulo' => [
        'authors' => 'A. Z. M. Tahmidul Kabir, et al.',
        'abstract' => 'This study applies deep learning and machine learning techniques to analyze neonatal mortality rates in São Paulo, identifying key risk factors and predictive patterns to improve healthcare outcomes.'
    ],
    'An intelligent wind turbine with yaw mechanism using machine learning to reduce high-cost sensors quantity' => [
        'authors' => 'A. Z. M. Tahmidul Kabir, M. S. Islam',
        'abstract' => 'Proposed an intelligent yaw mechanism for wind turbines that utilizes machine learning algorithms to optimize orientation without relying on expensive wind direction sensors, significantly reducing manufacturing costs.'
    ],
    'Smart vehicle management by using sensors and an IoT based black box' => [
        'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'A comprehensive vehicle management system utilizing IoT-enabled black boxes and sensor arrays to monitor vehicle health, driver behavior, and accident data in real-time.'
    ],
    'Smart vehicle management system for accident reduction by using sensors and an IoT based black box' => [
         'authors' => 'A. Z. M. Tahmidul Kabir, et al.',
        'abstract' => 'Development of a smart system designed to reduce traffic accidents through real-time monitoring and alert systems, leveraging IoT black box technology for post-accident analysis.'
    ],
    'A review on notification sending methods to the recipients in different technology-based women safety solutions' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'A comparative review of notification protocols in women\'s safety devices, analyzing the effectiveness of SMS, GPS, and IoT-based alert systems in emergency situations.'
    ],
    'An IoT Based Intelligent Parking System for the Unutilized Parking Area With Real-Time Monitoring Using Mobile and Web Application' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'An intelligent solution to optimize urban parking by identifying and managing unutilized spaces through a real-time IoT network connected to mobile and web applications.'
    ],
    'Data Augmentation Technique to Expand Road Dataset Using Mask RCNN and Image Inpainting' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
         'abstract' => 'Novel data augmentation technique combining Mask R-CNN and Image Inpainting to generate synthetic road datasets, improving the training of autonomous driving algorithms.'
    ],
    'IoT Based Smart Home Automation and Security System Using Mobile App With Assistant Robot for Developing Countries' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Design of a cost-effective smart home automation and security system tailored for developing countries, featuring mobile app control and an assistant robot for monitoring.'
    ],
    'A Comprehensive Smart IoT Tracker for the Children, Elder, and Luggage With the Assistance of Mobile App' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'A versatile IoT tracking device designed for the safety of children, elderly individuals, and tracking luggage, integrated with a user-friendly mobile application.'
    ],
    'Safety Solution for Women Using Smart Band and CWS App' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Implementation of a wearable smart band coupled with the CWS App to provide immediate emergency alerts and location tracking for women\'s safety.'
    ],
    'IoT Based Low Cost Smart Indoor Farming Management System Using an Assistant Robot and Mobile App' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'A low-cost, IoT-enabled indoor farming system that uses an assistant robot and mobile app to monitor and manage plant growth, humidity, and water levels efficiently.'
    ],
    'Automated Parking System with Fee Management Using Arduino' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Prototype of an automated car parking facility with an integrated fee management system, built using Arduino microcontrollers to automate entry/exit and billing.'
    ],
    'Six Tier Multipurpose Security Locker System Based on Arduino' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Development of a high-security six-tier locker system utilizing Arduino, providing multi-factor authentication and robust protection for securing valuables.'
    ],
    'An Intelligent Street Light System Based on Piezoelectricity Generator with Noticeable Zebra Crossing Point and Bus Stand' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'An energy-efficient street light system powered by piezoelectric generators, featuring intelligent illumination for zebra crossings and bus stands to enhance pedestrian safety.'
    ],
    'Intelligent Path-Finder for The Blind' => [
         'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'A smart assistive device for visually impaired individuals that detects obstacles and navigates paths using ultrasonic sensors and auditory feedback.'
    ],
     'Asian Journal of Contemporary Technology – Article 1' => [
        'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Research article published in the Asian Journal of Contemporary Technology discussing recent advancements in engineering and technology.'
    ],
    'Asian Journal of Contemporary Technology – Article 2' => [
        'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Follow-up research article in AJCT focusing on practical applications of embedded systems in industrial automation.'
    ],
    'International Journal of Informatics and Communication Technology (IJICT)' => [
        'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Contribution to IJICT exploring new paradigms in informatics and communication networks.'
    ],
    'International Journal of Reconfigurable and Embedded Systems (IJRES)' => [
        'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Published work in IJRES on reconfigurable computing architectures and their performance optimization.'
    ],
    'International Journal of Electrical and Computer Engineering (IJEECS)' => [
        'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Study presented in IJEECS analyzing electrical power systems and computer engineering integrations.'
    ],
    'International Journal of Public Health Science (IJPHS)' => [
        'authors' => 'A. Z. M. Tahmidul Kabir',
        'abstract' => 'Interdisciplinary research in IJPHS relating technology interventions to public health improvements.'
    ]
];

$stmt = $pdo->prepare("UPDATE publications SET authors = ?, abstract = ? WHERE title = ?");

foreach ($updates as $title => $data) {
    // Generate dummy tags if needed
    // $tags = json_encode(['IoT', 'Machine Learning']); 
    
    $stmt->execute([$data['authors'], $data['abstract'], $title]);
    if ($stmt->rowCount() > 0) {
        echo "Updated: $title\n";
    } else {
        echo "No change/Not found: $title\n";
    }
}
echo "Metadata update complete.\n";
