import os
import re

path = r"c:\xampp1\htdocs\Sama_College\index.php"
with open(path, "r", encoding="utf-8") as f:
    content = f.read()

lines = content.split("\n")
stack = []

for idx, line in enumerate(lines):
    line_num = idx + 1
    # Match standard if/elseif with colon
    # We clean PHP tags to make it easier
    line_clean = line.replace("<?php", "").replace("?>", "").strip()
    match_if = re.search(r'\b(if|elseif)\s*\([^)]+\)\s*:', line_clean)
    match_else = re.search(r'\belse\s*:', line_clean)
    match_endif = re.search(r'\bendif\s*;', line_clean)
    
    if match_if:
        cond = match_if.group(0)
        stack.append((line_num, cond))
        print(f"Open at line {line_num}: {cond}")
    elif match_else:
        stack.append((line_num, "else:"))
        print(f"Open at line {line_num}: else:")
    
    if match_endif:
        if stack:
            opened_line, opened_cond = stack.pop()
            print(f"  Closed at line {line_num} (matches line {opened_line} {opened_cond})")
        else:
            print(f"  Closed at line {line_num} with no open block!")

print(f"\nRemaining unclosed blocks on stack:")
for s in stack:
    print(f"  Line {s[0]}: {s[1]}")
