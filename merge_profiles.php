<?php
require_once 'config/db.php';

try {
    // 1. Delete the secondary profile (Google Sites)
    $deleteSql = "DELETE FROM publications WHERE title LIKE '%Extracurricular Activities Profile%'";
    $pdo->exec($deleteSql);
    echo "Deleted secondary profile.\n";

    // 2. Update the main profile (IEEE) with new Title and Secondary Link (in pdf_url)
    $ieee_link = 'https://ieeexplore.ieee.org/author/37087127618';
    $portfolio_link = 'https://sites.google.com/view/tahmidul-kabir/extracurricular-activities?authuser=0';
    $new_title = 'A. Z. M. Tahmidul Kabir';
    $new_abstract = 'Senior Member, IEEE. Researcher in IoT, Embedded Systems, and Machine Learning with a focus on sustainable solutions for developing countries.';

    $updateSql = "UPDATE publications SET 
                    title = ?, 
                    abstract = ?, 
                    pdf_url = ? 
                  WHERE link = ?";
    $stmt = $pdo->prepare($updateSql);
    $stmt->execute([$new_title, $new_abstract, $portfolio_link, $ieee_link]);
    
    echo "Updated main profile with merged data.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
