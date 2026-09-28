import re

with open('pages/events.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Let's search for "card" or how the image is rendered
matches = [m.start() for m in re.finditer(r'image_path|background:|src=', content)]
for m in matches:
    start = max(0, m - 150)
    end = min(len(content), m + 250)
    print(f"Match:\n{content[start:end]}\n" + "-"*50)
