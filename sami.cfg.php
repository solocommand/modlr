<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Resources')
    ->exclude('Tests')
    ->in($dir = '../modlr/src')
;

$versions = GitVersionCollection::create($dir)
    ->addFromTags('v1.*.*')
    ->add('master', 'master branch')
;

return new Sami($iterator, array(
    'theme'                => 'symfony',
    'versions'             => $versions,
    'title'                => 'modlr',
    'build_dir'            => __DIR__,
    'cache_dir'            => sprintf('%s/modlr/%%version%%', sys_get_temp_dir()),
    'remote_repository'    => new GitHubRemoteRepository('as3io/modlr', dirname($dir)),
    'default_opened_level' => 2,
));