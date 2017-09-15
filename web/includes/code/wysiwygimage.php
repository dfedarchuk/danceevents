<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* Getting Symfony Containers */
    $container = SymfonyCore::getContainer();

    /* Getting wysiwyg and translator services */
    $wysiwygService = $container->get('wysiwyg.service');

    $return = [];

    if ($_FILES['favicon_file']['name']) {
        /* FavIcon */
        $return = $wysiwygService->saveFavIcon($_FILES['favicon_file']);
    } elseif ($_FILES['header_image']['name']) {
        /* Site Logo */
        $return = $wysiwygService->saveLogo($_FILES['header_image']);
    } elseif ($_FILES['background_image']['name']) {
        /* Background Image */
        $return = $wysiwygService->saveBackgroundImage($_FILES['background_image'], 'background_image');
    } elseif ($_FILES['background_image_newsletter']['name']) {
        /* Newsletter Background Image */
        $return = $wysiwygService->saveBackgroundImage($_FILES['background_image_newsletter'], 'background_image_newsletter');
    } elseif ($_FILES['slideImage']['name']) {
        /* Slider Upload */
        $return = $container->get('imageuploader')->uploadSliderImages($_FILES['slideImage'], IMAGE_SLIDER_WIDTH, IMAGE_SLIDER_HEIGHT, $_GET['domain_id']);
    } elseif ($_FILES['background_image_location']['name']) {
        $return = $wysiwygService->saveBackgroundImage($_FILES['background_image_location'], 'background_image_location');
    } elseif ($_FILES['background_image_calendar']['name']) {
        /* Newsletter Background Image */
        $return = $wysiwygService->saveBackgroundImage($_FILES['background_image_calendar'], 'background_image_calendar');
    }

    echo json_encode($return);
}
