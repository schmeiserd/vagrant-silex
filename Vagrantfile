Vagrant.configure("2") do |config|
  config.vm.box = "hashicorp/precise32"
  config.vm.box_url = "http://files.vagrantup.com/precise32.box"
  config.vm.provision :shell, path: "./provision/bootstrap.sh"
  config.vm.network :forwarded_port, host: 8001, guest: 80
  config.vm.synced_folder "./silex", "/var/www/", type: "rsync"
  config.vm.synced_folder "./provision", "/home/vagrant/provision", type: "rsync"
end