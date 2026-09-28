import os

path = r"c:\xampp1\htdocs\Sama_College\index.php"
with open(path, "r", encoding="utf-8") as f:
    content = f.read()

# Let's count colons and endifs
ifs = len(content.split("if (")) - 1
elseifs = len(content.split("elseif (")) - 1
endifs = len(content.split("endif;")) - 1

print(f"File: {path}")
print(f"Number of 'if (': {ifs}")
print(f"Number of 'elseif (': {elseifs}")
print(f"Number of 'endif;': {endifs}")

# Let's check matching braces
braces_open = 0
braces_close = 0
for char in content:
    if char == '{':
        braces_open += 1
    elif char == '}':
        braces_close += 1

print(f"Braces: {braces_open} open, {braces_close} close, diff: {braces_open - braces_close}")
