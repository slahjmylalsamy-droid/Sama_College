import sys
sys.stdout.reconfigure(encoding='utf-8')

with open('pages/academic_calendar.php', 'r', encoding='utf-8') as f:
    content = f.read()

import re
pos = content.find('$events =')
if pos != -1:
    print("Found $events definition:")
    print(content[pos:pos+1500])
else:
    pos_table = content.find('<table')
    if pos_table != -1:
        print("Found table tags:")
        print(content[pos_table:pos_table+1500])
