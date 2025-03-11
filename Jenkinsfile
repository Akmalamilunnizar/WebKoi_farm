node {
    checkout scm
    // Deploy env dev
    stage("Build") {
        docker.image('php:8.1-cli').inside('-u root') {
            sh 'rm -f composer.lock'
            sh 'composer install'
        }
    }
    // Testing
    stage("Test") {
        docker.image('ubuntu').inside('-u root') {
            sh 'echo "Ini adalah test"'
        }
    }
}
