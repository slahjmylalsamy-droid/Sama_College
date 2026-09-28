import os
import re

walkthrough_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\walkthrough.md"
with open(walkthrough_path, "r", encoding="utf-8", errors="ignore") as f:
    content = f.read()

# Let's find all code blocks
# Code blocks are enclosed by triple backticks ```
code_blocks = re.findall(r"```[a-zA-Z0-9_-]*\n(.*?)```", content, re.DOTALL)
print("Total code blocks in walkthrough.md:", len(code_blocks))

found_count = 0
for idx, cb in enumerate(code_blocks):
    if "index.php" in cb or "layout_pages" in cb or "updateClock" in cb:
        found_count += 1
        print(f"\n--- Code Block {idx} (Length: {len(cb)}) ---")
        # Print first 200 and last 200 chars of code block
        print(cb[:300])
        print("...")
        print(cb[-300:])
