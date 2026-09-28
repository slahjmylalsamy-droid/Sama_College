import json
import re

path = r"c:\xampp1\htdocs\Sama_College\index_reconstructed_all.php"
with open(path, "r", encoding="utf-8") as f:
    content = f.read()

def safe_decode(match):
    val = match.group(0)
    try:
        # json.loads handles surrogate pairs correctly if they are combined,
        # but for individual escapes we can try loading as JSON string
        return json.loads(f'"{val}"')
    except:
        return val

# Replace \uXXXX sequences
# We also replace double escaped ones if any, like \\uXXXX
content = content.replace(r"\\u", r"\u")
decoded = re.sub(r'\\u[0-9a-fA-F]{4}', safe_decode, content)

with open(path, "w", encoding="utf-8", errors="ignore") as f:
    f.write(decoded)

print("Decoded all unicode escapes in index_reconstructed_all.php safely!")
