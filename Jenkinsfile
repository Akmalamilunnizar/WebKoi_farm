node {
    checkout scm

    // Build tahap install dependensi
    stage("Build") {
        docker.image('composer:2.8').inside('-u root') {
            sh 'php --version'
            sh 'composer --version'
            sh 'rm -f composer.lock'
            sh 'composer install --no-dev --prefer-dist'
        }
    }

    // Testing Laravel (Pastikan Laravel ada di proyek)
    stage("Test") {
        docker.image('php:8.2-cli').inside('-u root') {
            sh 'php artisan test'
        }
    }
}
