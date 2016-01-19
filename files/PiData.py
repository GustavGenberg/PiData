import psutil
import time
import commands

########## CONFIGURATION ##########

TEMP_SHUTDOWN = False
TEMP_SHUTDOWN_LIMIT = 50 #CELSIUS

CPU_SHUTDOWN = False
CPU_SHUTDOWN_LIMIT = 75 #PERCENT

RAM_SHUTDOWN = False
RAM_SHUTDOWN_LIMIT = 75 #PERCENT

DISK_SHUTDOWN = False
DISK_SHUTDOWN_LIMIT = 75 #PERCENT

PiData_UPDATE_INTERVAL = 1000 #MILLISECONDS
PiData_ACTIVE = True

######## END CONFIGURATION ########


########### PiData Code ###########
global PiInfo, cpu_temperature, cpu_percent_usage, ram_total, ram_used, ram_free, ram_percent_usage, disk_total, disk_used, disk_free, disk_percent_usage
def PiData():
   PiInfo = []
   cpu_temperature = commands.getstatusoutput('vcgencmd measure_temp')[1]
   cpu_percent_usage = psutil.cpu_percent()
   ram_total = psutil.phymem_usage().total / 2**20       # MiB.
   ram_used = psutil.phymem_usage().used / 2**20
   ram_free = psutil.phymem_usage().free / 2**20
   ram_percent_usage = psutil.phymem_usage().percent
   disk_total = psutil.disk_usage('/').total / 2**30     # GiB.
   disk_used = psutil.disk_usage('/').used / 2**30
   disk_free = psutil.disk_usage('/').free / 2**30
   disk_percent_usage = psutil.disk_usage('/').percent
   PiInfo.append(cpu_temperature)
   PiInfo.append(cpu_percent_usage)
   PiInfo.append(ram_total)
   PiInfo.append(ram_used)
   PiInfo.append(ram_free)
   PiInfo.append(ram_percent_usage)
   PiInfo.append(disk_total)
   PiInfo.append(disk_used)
   PiInfo.append(disk_free)
   PiInfo.append(disk_percent_usage)
   
   return PiInfo

if PiData_ACTIVE:

   print "PiData Active - Running"

   while True:
      with open('/home/pi/PiData/PiData.txt', 'w') as PiDataFile:
         for item in PiData():
            PiDataFile.write("%s\n" % item)
      time.sleep(0.001 * PiData_UPDATE_INTERVAL)
else:
   print "PiData Not Active - Not Running"
   print "You Can Exit This Script With CTRL+C"
