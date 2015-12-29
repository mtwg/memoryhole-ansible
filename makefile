.PHONY: build

build:
	@brew install ansible openssl
	@git submodule init
	@echo "======MEMORYHOLE=======\n\t - dont forget to customize app/custom/includes/language/en_us.lang.php \n\t - Don't forget to add your deploy/hosts IP address"

audit:
	@ansible-playbook -i deploy/hosts runalone/cis-rhel-ansible/playbook.yml

certs:
	@openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout deploy/certificates/memoryhole.key -out deploy/certificates/memoryhole.crt

ansible-deploy:
	@ansible-playbook -i deploy/hosts deploy/server.yml
	@ansible-playbook -i deploy/hosts deploy/deploy.yml

deploy: certs audit ansible-deploy 
