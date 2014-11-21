# -*- mode: ruby -*-
# ex: ft=ruby et ts=2 sw=2:

github_username = "fideloper"
github_repo     = "Vaprobash"
github_branch   = "1.0.1"
github_url      = "https://raw.githubusercontent.com/#{github_username}/#{github_repo}/#{github_branch}"

hostname = "phrases.local"

server_ip     = "192.168.22.10"
server_memory = "384"
server_swap   = "768"

server_timezone = "UTC"

mysql_root_password = "root"
mysql_version       = "5.6"
mysql_enable_remote = "true"

php_timezone = "UTC"
hhvm         = "false"

public_folder         = "/vagrant"

Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu/trusty64"

  config.vm.define "Vaprobash" do |vapro|
  end

  config.vm.hostname = hostname

  config.vm.network :private_network, ip: server_ip

  config.vm.synced_folder ".", "/vagrant",
            id: "core",
            :nfs => true,
            :mount_options => ['nolock,vers=3,udp,noatime']

  config.vm.provider :virtualbox do |vb|
    vb.name = "Vaprobash-phrases"
    vb.customize ["modifyvm", :id, "--memory", server_memory]
    vb.customize ["guestproperty", "set", :id, "/VirtualBox/GuestAdd/VBoxService/--timesync-set-threshold", 10000]
  end

  if Vagrant.has_plugin?("vagrant-cachier")
    config.cache.scope = :box
    config.cache.synced_folder_opts = {
        type: :nfs,
        mount_options: ['rw', 'vers=3', 'tcp', 'nolock']
    }
  end

  config.vm.provision "shell",
    inline: "echo setting timezone to #{server_timezone}; ln -sf /usr/share/zoneinfo/#{server_timezone} /etc/localtime"
  config.vm.provision "shell", path: "#{github_url}/scripts/base.sh", args: [github_url, server_swap]
  config.vm.provision "shell", path: "#{github_url}/scripts/php.sh", args: [php_timezone, hhvm]
  config.vm.provision "shell", path: "#{github_url}/scripts/vim.sh", args: github_url
  config.vm.provision "shell", path: "#{github_url}/scripts/nginx.sh", args: [server_ip, public_folder, hostname, github_url]
  config.vm.provision "shell", path: "#{github_url}/scripts/mysql.sh", args: [mysql_root_password, mysql_version, mysql_enable_remote]
end
