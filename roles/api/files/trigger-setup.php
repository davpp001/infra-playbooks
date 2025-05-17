<?php
if (\$_SERVER['REQUEST_METHOD']!=='POST') { http_response_code(405); exit; }
\$input = json_decode(file_get_contents('php://input'), true);
if (empty(\$input['subdomain']) || !preg_match('/^[a-z0-9-]+$/', \$input['subdomain'])) {
  http_response_code(400); echo "Invalid subdomain"; exit;
}
\$sub = \$input['subdomain'];
\$cmd = sprintf(
  'nohup /usr/local/bin/setup_wp %s > /var/log/setup_wp.log 2>&1 &',
  escapeshellarg(\$sub)
);
exec(\$cmd, \$out, \$rc);
if (\$rc===0) { http_response_code(202); echo "Triggered: \$sub"; }
else          { http_response_code(500); echo "Trigger failed"; }
