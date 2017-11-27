@servers(['web' => ['deploybot@139.162.156.74']])

@task('deploy_production', ['on' => 'web'])
cd humansvszombies_production/NerdRunClub
git reset --hard HEAD~1
git pull
@endtask