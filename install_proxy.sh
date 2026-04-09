#!/bin/bash
is_dante = dpkg-query -w -f="${status}" dante-server 2>/dev/null | grep "ok installed"
if ! $is_dante; then
	echo "Dante installing..."
	apt update && apt unstall -y dante-server
else
echo "Dante installed. Continue"
fi
mv /etc/danted.conf /etc/danted.conf.bak

cat <<EOF> /etc/danted.conf
logoutput: syslog
user.privileged: root
user.unprivileged: proxy

internal: 0.0.0.0 port = 1080
external: ens3

socksmethod: username none
clientmethod: none

client pass {
	from: 0.0.0.0/0 to: 0.0.0.0/0
}

socks pass {
	from: 0.0.0.0/0 to: 0.0.0.0/0
}
EOF
if ss -tuln | grep -q ":1080 "; then
	echo "port bussy"
else echo "port not use.Try start dante"

fi

if ! iptables -L INPUT -n | grep -q "1080"; then
	echo "Rule for port 1080 not found. Try to add rule"
	iptables -I INPUT -p tcp --dport 1080 -j ACCEPT
else
	echo "Fierwall  rules exist"
fi
systemctl restart danted
systemctl enable danted

