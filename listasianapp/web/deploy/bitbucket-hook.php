<?php
$repo_dir = '/home/admin/web/list.asiandirectoryapp.com/app';
$web_root_dir = '/home/admin/web/list.asiandirectoryapp.com/app/www';

// Full path to git binary is required if git is not in your PHP user's path. Otherwise just use 'git'.
$git_bin_path = 'git';


  // Do a git checkout to the web root
exec('cd ' . $repo_dir . ' && git pull && rm -rf ' . $web_root_dir  . '/assets/*');
