VAGRANTFILE_API_VERSION = '2'
BOX                     = 'govready-centos-6.5-x86_64'
BOX_URL                 = 'https://a7240500425256e5d77a-9064bd741f55664f44e550bdad2949f9.ssl.cf5.rackcdn.com/govready-centos-6.5-x86_64-noX-0.2.1-server-0.8.1.box'


Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    config.vm.box       = 'debian/jessie64'
    config.vm.define 'memoryhole' do |memoryhole|
        memoryhole.vm.network :private_network, ip: "192.168.111.222"
        memoryhole.vm.network "forwarded_port", guest: 80, host: 8181
        memoryhole.vm.network "forwarded_port", guest: 443, host: 8282
        memoryhole.vm.synced_folder './app', '/var/www/html',
          owner: "root",
          group: "root"
        memoryhole
        memoryhole.vm.provision :ansible do |ansible|
            ansible.playbook        = 'deploy/server.yml'
            ansible.sudo            = true
            ansible.groups = {
              "webserver" => ["memoryhole"],
              "database" => ["memoryhole"],
              "all_groups:children" => ["webserver", "database"]
            }
            ansible.raw_arguments  = [
              "-e city_key=example",
            ]
        end
        memoryhole.vm.provision :ansible do |ansible|
            ansible.playbook        = 'deploy/deploy.yml'
            ansible.sudo            = true
            ansible.groups = {
              "webserver" => ["memoryhole"],
              "database" => ["memoryhole"],
              "all_groups:children" => ["webserver", "database"]
            }
            ansible.raw_arguments  = [
              "-e city_key=example",
            ]
        end
    end
end
