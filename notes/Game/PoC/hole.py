import random

datafolder = "../data/"

class Player:
    def __init__(self,name):
        self.name = name
        self.items = ["bible"]

    def enter(self,room):
        print "You enter room %d. %s" % (room.roomid,"\n".join(room.description))
        if room.items != [""]:
            print "In this room there are the following items: " + ", ".join(room.items)
        if room.monsters != [""]:
            print "In this room there are the following monsters: " + ", ".join(room.monsters)
        print
        if self.items != [""]:
            print "You have the following items: " + ", ".join(self.items)
        todel = []
        if room.items != [""]:
            todel = []
            for i in room.items:
                take = raw_input("Do you wish to take the %s? (y/n) " % i)
                if take == "y":
                    self.items.append(i)
                    todel.append(room.items.index(i))
        if todel :
            for i in todel:
                del room.items[i]
                
        print
        room.description.append(self.add_journal(room))
        print

    def add_journal(self,room):
        entry = "%s wrote: %s" % (self.name,raw_input("Please write a journal entry for this room: "))
        return entry


class Monster:
    def __init__(self,name,description,loot,status):
        self.name = name
        self.description = description
        self.loot = loot
        self.status = status


class Item:
    def __init__(self,name,description):
        self.name = name
        self.description = description


class Room:
    def __init__(self,roomid,sizex,sizey,description,items,monsters,exits):
        self.roomid = roomid
        self.items = items
        self.monsters = monsters 
        if sizex == 0:
            self.sizex=random.randint(1,3)
        else:
            self.sizex = sizex

        if sizey == 0:
            self.sizey=random.randint(1,3)
        else:
            self.sizey = sizex

        if description == [""]:
            self.description = self.create_description()
        else:
            self.description = description

    def random_event(self):
        pass

    def create_description(self):
        desc = [0]
        desc[0] = "This room is %d meters wide and %d meters long." % (self.sizex*2,self.sizey*2)
        #random chance of adding a feature
        #if random.randint(0,2) == 0:
        #    features = open(datafolder+"gen/features.txt").readlines()
        #    desc.append(random.choice(features).strip())
        #return desc

def read_rooms(f):
    l = []
    l.append(Room(0,2,3,["This room is 4 meters wide and 6 meters long.","Jonathan Walker wrote: I entered this room, starving from lack of food - it has been months since I've eaten. I found none, and despaired. My life has been cruel to me, and I turned my pistol on myself, freeing myself from my burdens.","A dead man lies on the floor."],["Pistol","Candlestick"],[""],[81]))
    l.append(Room(1,1,1,["This room is 2 meters wide and 2 meters long."],[""],["Bear"],[21]))
    return l

# main

if __name__ == '__main__':
    rooms = read_rooms(datafolder+"/rooms/rooms.txt")
    current_player = Player("Ienpw III")
    current_player.enter(rooms[0])
    current_player.enter(rooms[1])
    current_player.enter(rooms[0])