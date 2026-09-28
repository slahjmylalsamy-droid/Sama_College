import os

path = r"c:\xampp1\htdocs\Sama_College\index_reconstructed_all.php"
with open(path, "r", encoding="utf-8") as f:
    content = f.read()

import re
matches = re.findall(r"include\s+['\"][^'\"]*['\"];|require\s+['\"][^'\"]*['\"];", content)
print("Found includes:")
for m in matches:
    print(" ", m)
