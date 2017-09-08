<?php if(base_layout_has('page_title')) {
    echo 'Hello World';
}

base_layout('nested-var-exists/child', ['page_title' => true]);
