pipeline {
    agent any

    stages {
        stage('BUILD'){
            steps {
                script{
                    docker.build("caetanodevops/mentorr-backend-live:${env.BUILD_NUMBER}")
                }
            }
        }
    }
}
