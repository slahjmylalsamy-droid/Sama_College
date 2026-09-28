import os

path = r"c:\xampp1\htdocs\Sama_College\index_reconstructed_all.php"
with open(path, "r", encoding="utf-8") as f:
    lines = f.readlines()

print(f"Searching for 'endif', 'footer', or structural closures after line 2000:")
for i in range(2000, len(lines)):
    line = lines[i]
    line_num = i + 1
    # Check for keywords
    if any(k in line for k in ["endif;", "footer", "</main>", "</footer>", "<!-- ====="]):
        # Ignore false matches like Tool view_file
        if "Tool" not in line:
            print(f"Line {line_num}: {line.strip()}")
