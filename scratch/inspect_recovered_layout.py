import os

path = r"c:\xampp1\htdocs\Sama_College\scratch\git_recovered_v2_1.php"
with open(path, "r", encoding="utf-8", errors="ignore") as f:
    content = f.read()

print("File size:", len(content))
# Let's search for some text
import re
arrays = re.findall(r"\$\w+\s*=\s*\[", content)
print("Arrays found:", arrays)

# Is layout_pages in the file?
print("Is layout_pages in file?", "layout_pages" in content)
# Is updateClock in the file?
print("Is updateClock in file?", "updateClock" in content)
