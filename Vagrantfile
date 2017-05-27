VAGRANTFILE_API_VERSION = '2'
BOX                     = 'debian/jessie64'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    config.vm.box       = 'debian/jessie64'
    config.vm.post_up_message = 'the application is now available at https://192.168.111.222'
    config.vm.define 'memoryhole' do |memoryhole|
        memoryhole.vm.provider :virtualbox do |v|
          v.customize ["modifyvm", :id, "--memory", 2048]
          v.customize ["modifyvm", :id, "--cpus", 2]
        end
        memoryhole.vm.network :private_network, ip: "192.168.111.222"
        memoryhole.vm.network "forwarded_port", guest: 80, host: 8181
        memoryhole.vm.network "forwarded_port", guest: 443, host: 8282
        memoryhole.vm.provision :ansible do |ansible|
            ansible.playbook        = 'deploy/server.yml'
            ansible.sudo            = true
            ansible.groups = {
              "webserver" => ["memoryhole"],
              "database" => ["memoryhole"],
              "all_groups:children" => ["webserver", "database"]
            }
            ansible.raw_arguments  = [
              "-e city_key=example letsencrypt_server=https://acme-staging.api.letsencrypt.org/directory localssl=true",
            ]
        end
    end
end
