<?php
$file = __DIR__ . '/../includes/lang.php';
$content = file_get_contents($file);

$new_ru = [
    'structure_detail_intro' => 'Краткое описание деятельности отдела',
    'structure_detail_photo_placeholder' => 'Место для фотографии отдела',
    'structure_detail_staff_title' => 'Руководители и сотрудники',
    'structure_detail_head' => 'Руководитель',
    'structure_detail_experience' => 'Опыт:',
    'structure_detail_years' => 'лет',
    'structure_detail_research_title' => 'Основные направления исследований',
    'structure_detail_results_title' => 'Ключевые результаты и достижения отдела',
    'structure_detail_international_title' => 'Международные проекты',
    'structure_detail_international_coop' => 'Сотрудничество и обмен',
    'structure_detail_projects_current' => 'Текущие научные проекты',
    'structure_detail_projects_completed' => 'Завершённые проекты',
    'structure_detail_publications_title' => 'Публикации отдела',
    'structure_detail_publications_desc' => 'Статьи, монографии, рекомендации',
    'structure_detail_goals_title' => 'Цели отдела',
    'structure_detail_perspectives_title' => 'Перспективы развития',
    'structure_detail_services_title' => 'Услуги и товары отдела',
    'structure_detail_events_title' => 'Научные мероприятия',
    'structure_detail_infrastructure_title' => 'Материально-техническая база',
    'structure_detail_cta_title' => 'Свяжитесь с отделом',
    'structure_detail_cta_desc' => 'Для получения дополнительной информации о деятельности отдела, сотрудничестве или приобретении семенного материала',
    'structure_detail_cta_btn' => 'Контакты'
];

$new_en = [
    'structure_detail_intro' => 'Brief description of department activities',
    'structure_detail_photo_placeholder' => 'Placeholder for department photo',
    'structure_detail_staff_title' => 'Management and Staff',
    'structure_detail_head' => 'Head of Department',
    'structure_detail_experience' => 'Experience:',
    'structure_detail_years' => 'years',
    'structure_detail_research_title' => 'Main research directions',
    'structure_detail_results_title' => 'Key results and achievements of the department',
    'structure_detail_international_title' => 'International Projects',
    'structure_detail_international_coop' => 'Cooperation and Exchange',
    'structure_detail_projects_current' => 'Current scientific projects',
    'structure_detail_projects_completed' => 'Completed projects',
    'structure_detail_publications_title' => 'Department Publications',
    'structure_detail_publications_desc' => 'Articles, monographs, recommendations',
    'structure_detail_goals_title' => 'Department Goals',
    'structure_detail_perspectives_title' => 'Development Perspectives',
    'structure_detail_services_title' => 'Services and Products of the Department',
    'structure_detail_events_title' => 'Scientific Events',
    'structure_detail_infrastructure_title' => 'Material and Technical Base',
    'structure_detail_cta_title' => 'Contact the Department',
    'structure_detail_cta_desc' => 'For additional information about the department\'s activities, cooperation, or purchasing seed material',
    'structure_detail_cta_btn' => 'Contacts'
];

$new_ky = [
    'structure_detail_intro' => 'Бөлүмдүн ишмердүүлүгүнүн кыскача сүрөттөлүшү',
    'structure_detail_photo_placeholder' => 'Бөлүмдүн сүрөтү үчүн орун',
    'structure_detail_staff_title' => 'Жетекчилик жана кызматкерлер',
    'structure_detail_head' => 'Жетекчи',
    'structure_detail_experience' => 'Тажрыйбасы:',
    'structure_detail_years' => 'жыл',
    'structure_detail_research_title' => 'Изилдөөлөрдүн негизги багыттары',
    'structure_detail_results_title' => 'Бөлүмдүн негизги жыйынтыктары жана жетишкендиктери',
    'structure_detail_international_title' => 'Эл аралык долбоорлор',
    'structure_detail_international_coop' => 'Кызматташтык жана алмашуу',
    'structure_detail_projects_current' => 'Учурдагы илимий долбоорлор',
    'structure_detail_projects_completed' => 'Аяктаган долбоорлор',
    'structure_detail_publications_title' => 'Бөлүмдүн басылмалары',
    'structure_detail_publications_desc' => 'Макалалар, монографиялар, сунуштамалар',
    'structure_detail_goals_title' => 'Бөлүмдүн максаттары',
    'structure_detail_perspectives_title' => 'Өнүгүү перспективалары',
    'structure_detail_services_title' => 'Бөлүмдүн кызматтары жана товарлары',
    'structure_detail_events_title' => 'Илимий иш-чаралар',
    'structure_detail_infrastructure_title' => 'Материалдык-техникалык база',
    'structure_detail_cta_title' => 'Бөлүм менен байланышыңыз',
    'structure_detail_cta_desc' => 'Бөлүмдүн ишмердүүлүгү, кызматташуу же үрөн материалын сатып алуу боюнча кошумча маалымат алуу үчүн',
    'structure_detail_cta_btn' => 'Байланыштар'
];

function insert_keys($content, $lang, $new_keys) {
    // Find the beginning of the language array
    $pattern = "/('$lang'|\"$lang\")\s*=>\s*\[/i";
    if (preg_match($pattern, $content, $matches, PREG_OFFSET_CAPTURE)) {
        $start_pos = $matches[0][1] + strlen($matches[0][0]);
        
        $insert_str = "\n";
        foreach ($new_keys as $k => $v) {
            $insert_str .= "        '$k' => '" . addslashes($v) . "',\n";
        }
        
        $content = substr_replace($content, $insert_str, $start_pos, 0);
    }
    return $content;
}

$content = insert_keys($content, 'ru', $new_ru);
$content = insert_keys($content, 'en', $new_en);
$content = insert_keys($content, 'ky', $new_ky);

file_put_contents($file, $content);
echo "Translations added successfully!\n";
