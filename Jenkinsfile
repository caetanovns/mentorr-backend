pipeline {
    agent any

    stages {
        stage('BUILD'){
            steps {
                script{
                    dockerapp = docker.build("caetanodevops/mentorr-backend-live:${env.BUILD_NUMBER}")
                }
            }
        }

        stage("REGISTRY"){
            steps {
                script {
                    docker.withRegistry('https://index.docker.io/v1/', 'dockerhub') {
                        dockerapp.push()
                    }
                }
            }
        }
    }
}
