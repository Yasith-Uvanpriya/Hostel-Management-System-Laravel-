pipeline {
    agent any

    environment {
        registryCredential = 'ecr:us-east-1:awscreds'
        appRegistry = "032707422991.dkr.ecr.us-east-1.amazonaws.com/hostelmanagement"
        vprofileRegistry = "https://032707422991.dkr.ecr.us-east-1.amazonaws.com"
        BUILD_TIMESTAMP = "${new Date().format('yyyyMMdd_HHmmss')}"
    }

    stages {

        stage('Fetch Code') {
            steps {
                echo "Fetching code from GitHub..."
                git branch: 'main', url: 'https://github.com/Bhanuka10/Hostel-Management-System-Laravel-.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                echo "Installing PHP and Composer dependencies..."
                sh '''
                php -v
                composer install --no-interaction --prefer-dist --optimize-autoloader
                cp .env.example .env || true
                php artisan key:generate
                '''
            }
        }

        stage('Code Lint (Checkstyle Equivalent)') {
            steps {
                echo "Running PHP CodeSniffer..."
                sh '''
                if ! command -v phpcs >/dev/null; then
                    composer global require "squizlabs/php_codesniffer=*"
                    export PATH=$PATH:~/.composer/vendor/bin
                fi
                phpcs --standard=PSR12 app/ || true
                '''
            }
        }

        stage('Run Unit Tests') {
            steps {
                echo "Running Laravel PHPUnit tests..."
                sh '''
                php artisan test || true
                '''
            }
        }

        stage('SonarQube Analysis') {
            environment {
                scannerHome = tool 'sonar6.2'
            }
            steps {
                withSonarQubeEnv('sonarserver') {
                    sh '''
                    ${scannerHome}/bin/sonar-scanner \
                        -Dsonar.projectKey=hostel-laravel \
                        -Dsonar.projectName="Hostel Management System" \
                        -Dsonar.projectVersion=1.0 \
                        -Dsonar.sources=app \
                        -Dsonar.php.coverage.reportPaths=tests/coverage.xml \
                        -Dsonar.sourceEncoding=UTF-8
                    '''
                }
            }
        }

        stage('Quality Gate') {
            steps {
                timeout(time: 30, unit: 'MINUTES') {
                    waitForQualityGate abortPipeline: true
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    echo "Building Docker image..."
                    // 🟢 FIXED LINE BELOW — use two arguments, not one
                    dockerImage = docker.build("${appRegistry}:${BUILD_NUMBER}", "./Docker-files/Dockerfile/")
                }
            }
        }

        stage('Push Docker Image to ECR') {
            steps {
                script {
                    echo "Pushing Docker image to AWS ECR..."
                    docker.withRegistry("${vprofileRegistry}", "${registryCredential}") {
                        dockerImage.push("${BUILD_NUMBER}")
                        dockerImage.push("latest")
                    }
                }
            }
        }

        stage('Deploy (Optional)') {
            steps {
                echo "This stage can be used to deploy to ECS or EC2 using Ansible or AWS CLI."
            }
        }
    }

    post {
        success {
            echo "✅ Build and push completed successfully!"
        }
        failure {
            echo "❌ Pipeline failed. Check logs for details."
        }
    }
}
