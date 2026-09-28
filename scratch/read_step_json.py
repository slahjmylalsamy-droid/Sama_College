import json

filepath = r"c:\xampp1\htdocs\Sama_College\scratch\step_5886.json"
with open(filepath, "r", encoding="utf-8") as f:
    data = json.load(f)

print("Keys:", data.keys())
content = data.get("content", "")
print("Content length:", len(content))
print("Content sample (first 500 chars):", content[:500])
print("Content sample (last 500 chars):", content[-500:])

if "liveClock" in content:
    print("liveClock is indeed in content!")
