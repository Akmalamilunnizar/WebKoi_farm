node {
    checkout scm
    // deploy env dev
    stage("Build") {
        docker.image('shippingdocker/php-composer:8.1').inside('-u root') {
            sh 'rm -f composer.lock'
            sh 'composer install'
        }
    }
    // Testing
    docker.image('ubuntu').inside('-u root') {
        sh 'echo "Ini adalah test"'
    }
}
