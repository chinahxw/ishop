var config = {};
var redis = {};

config['host']      = '192.168.0.133';
config['port']      = '3306';
config['user']      = 'root';
config['password']      = 'klpassword';
/*config['host']      = '127.0.0.1';
config['port']      = '3306';
config['user']      = 'root';
config['password']      = '123456';*/
config['database']      = 'share_rent';
config['tablepre']      = '';

config['insecureAuth']      = true;
config['debug']      = false;
config['ssl_crt_file'] = '/mnt/e/code/dev/certs/sn.kela.cn.crt';
config['ssl_key_file'] = "/mnt/e/code/dev/certs/sn.kela.cn.key";

redis['host'] = '192.168.0.94';
// redis['host'] = '127.0.0.1';
redis['port'] = 6379;
redis['prefix'] = 'afefc5_';

exports.hostname = 'kela.cn';
exports.port = 3000;
exports.sslport = 3001;
exports.config = config;
exports.redisConfig = redis;


