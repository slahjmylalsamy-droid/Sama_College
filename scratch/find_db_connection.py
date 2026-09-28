import sys
sys.stdout.reconfigure(encoding='utf-8')

with open('index.php', 'r', encoding='utf-8') as f:
    content = f.read()

import re
pos = content.find('mysqli_connect(')
if pos != -1:
    print(content[pos-100:pos+500])
else:
    print("mysqli_connect not found")
