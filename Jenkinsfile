node {

    checkout scm

    stage("Build") {
        docker.image('php:8.3-cli').inside('-u root') {
            sh 'apt-get update'
            sh 'apt-get install -y git curl unzip libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev'
            sh 'docker-php-ext-configure gd --with-freetype --with-jpeg'
            sh 'docker-php-ext-install gd zip'
            sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer'
            sh 'git config --global --add safe.directory /var/jenkins_home/workspace/laravel-dev'
            sh 'php -v'
            sh 'composer install'
        }
    }

    stage("Testing") {
        docker.image('ubuntu').inside('-u root') {
            sh 'echo "Ini adalah test"'
        }
    }

        stage("Deploy") {
        docker.image('agung3wi/alpine-rsync:1.1').inside('-u root') {
            sshagent(credentials: ['ssh-prod']) {
                sh 'mkdir -p ~/.ssh'
                sh 'ssh-keyscan -H 20.205.28.51 >> ~/.ssh/known_hosts'
                sh '''
                rsync -rav --delete ./ \
                quincy@20.205.28.51:/home/quincy/prod.kelasdevops.xyz/ \
                --exclude=.env \
                --exclude=storage \
                --exclude=.git
                '''
            }
        }
    }

}