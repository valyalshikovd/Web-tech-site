<?php
return [
    '' => [
        'controller' => 'main',
        'action' => 'index'
        ],
    'comment/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'comment'
    ],
    'about' => [
        'controller' => 'main',
        'action' => 'about'
    ],
    'contacts' => [
        'controller' => 'main',
        'action' => 'contacts'
    ],
    'post/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'post'
    ],
    'login' => [
        'controller' => 'main',
        'action' => 'login'
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout'
    ],
    'admin/addPost' => [
        'controller' => 'admin',
        'action' => 'addPost'
    ],
    'admin/deletePost/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'deletePost'
    ],
    'admin/comments/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'comments'
    ],
    'admin/editPost/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'editPost'
    ],
    'admin/editComment/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'editComment'
    ],
    'admin/deleteComment/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'deleteComment'
    ],
    'admin/posts' => [
        'controller' => 'admin',
        'action' => 'posts'
    ],
];