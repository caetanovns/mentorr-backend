pipeline {
    agent any

    environment {
        DOCKER_CONTAINER = 'cool_solomon'
        WORKLOAD = 'mentorr-backend-live'
        CONTAINER = 'mentorr-backend-live'
        IMAGE = "caetanodevops/mentorr-backend-live:${env.BUILD_NUMBER}"
    }

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

        stage("DEPLOY"){
            steps {
                sh """
                    docker exec ${DOCKER_CONTAINER} kubectl set image deployment/${WORKLOAD} ${CONTAINER}=${IMAGE} -n default
                """
            }
        }
    }
}
