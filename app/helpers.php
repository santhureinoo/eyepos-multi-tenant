<?php
// Application Version
if (! function_exists('version_app')) {
    function version_app(): string
    {
        return exec('git --git-dir ' . base_path('.git') . ' describe --tags') . trim(exec('git --git-dir ' . base_path('.git') . ' log --pretty="%h" -n1 HEAD'));
    }
}
