<?php
include_once 'db.php';
class BidItem extends Db
{
    public function getAllItem()
    {
        try {
            $sql = "SELECT * FROM `auction` WHERE 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function addProduct($arrayProduct)
    {
        try {
            $sql = "INSERT INTO `auction`(`user_id`, `title`, `description`, `starting_bid`, `current_bid`, `image_url`, `end_time`) VALUES(:user_id,:title,:description,:starting_bid,:current_bid,:image_url,:end_time)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $arrayProduct['user_id']);
            $stmt->bindParam(':title', $arrayProduct['title']);
            $stmt->bindParam(':description', $arrayProduct['description']);
            $stmt->bindParam(':starting_bid', $arrayProduct['starting_bid']);
            $stmt->bindParam(':current_bid', $arrayProduct['current_bid']);
            $stmt->bindParam(':image_url', $arrayProduct['image_url']);
            $stmt->bindParam(':end_time', $arrayProduct['end_time']);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getSingleItem($id)
    {
        try {
            $sql = "SELECT * FROM `auction` WHERE `id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function updateProduct($arrayProduct)
    {
        try {
            $sql = "UPDATE `auction` SET `user_id`=:user_id,`title`=:title,`description`=:description,`starting_bid`=:starting_bid,`current_bid`=:current_bid,`image_url`=:image_url,`end_time`=:end_time WHERE `id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $arrayProduct['id']);
            $stmt->bindParam(':user_id', $arrayProduct['user_id']);
            $stmt->bindParam(':title', $arrayProduct['title']);
            $stmt->bindParam(':description', $arrayProduct['description']);
            $stmt->bindParam(':starting_bid', $arrayProduct['starting_bid']);
            $stmt->bindParam(':current_bid', $arrayProduct['current_bid']);
            $stmt->bindParam(':image_url', $arrayProduct['image_url']);
            $stmt->bindParam(':end_time', $arrayProduct['end_time']);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function deleteProduct($id)
    {
        try {
            $sql = "DELETE FROM `auction` WHERE `id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getBidItem($id)
    {
        try {
            $sql = "SELECT * FROM `bid` WHERE `auction_id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function addBid($arrayBid)
    {
        try {
            $sql = "INSERT INTO `bid`(`user_id`, `auction_id`, `bid_amount`) VALUES(:user_id,:auction_id,:bid_amount)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $arrayBid['user_id']);
            $stmt->bindParam(':auction_id', $arrayBid['auction_id']);
            $stmt->bindParam(':bid_amount', $arrayBid['bid_amount']);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function updateBid($arrayBid)
    {
        try {
            $sql = "UPDATE `bid` SET `user_id`=:user_id,`auction_id`=:auction_id,`bid_amount`=:bid_amount WHERE `id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $arrayBid['id']);
            $stmt->bindParam(':user_id', $arrayBid['user_id']);
            $stmt->bindParam(':auction_id', $arrayBid['auction_id']);
            $stmt->bindParam(':bid_amount', $arrayBid['bid_amount']);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function deleteBid($id)
    {
        try {
            $sql = "DELETE FROM `bid` WHERE `id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getBid($id)
    {
        try {
            $sql = "SELECT * FROM `bid` WHERE `id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getBidByUser($id)
    {
        try {
            $sql = "SELECT * FROM `bid` WHERE `user_id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getBidByAuction($id)
    {
        try {
            $sql = "SELECT * FROM `bid` WHERE `auction_id`=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getBidByAuctionUser($auction_id, $user_id)
    {
        try {
            $sql = "SELECT * FROM `bid` WHERE `auction_id`=:auction_id AND `user_id`=:user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':auction_id', $auction_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getBidByAuctionUserAmount($auction_id, $user_id, $amount)
    {
        try {
            $sql = "SELECT * FROM `bid` WHERE `auction_id`=:auction_id AND `user_id`=:user_id AND `bid_amount`=:amount";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':auction_id', $auction_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getBidByAuctionAmount($auction_id, $amount)
    {
        try {
            $sql = "SELECT * FROM `bid` WHERE `auction_id`=:auction_id AND `bid_amount`=:amount";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':auction_id', $auction_id);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getBidByAuctionAmountUser($auction_id, $amount, $user_id)
    {
        try {
            $sql = "SELECT * FROM `bid` WHERE `auction_id`=:auction_id AND `bid_amount`=:amount AND `user_id`=:user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':auction_id', $auction_id);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function getBidByAuctionAmountUserDate($auction_id, $amount, $user_id, $date)
    {
        try {
            $sql = "SELECT * FROM `bid` WHERE `auction_id`=:auction_id AND `bid_amount`=:amount AND `user_id`=:user_id AND `bid_date`=:date";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':auction_id', $auction_id);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':date', $date);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count > 0 && !empty($row)) {
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
}
// $stmt->bindParam(':user_id', $arrayProduct['user_id']);
// $stmt->bindParam(':title', $arrayProduct['title']);
// $stmt->bindParam(':description', $arrayProduct['description']);
// $stmt->bindParam(':starting_bid', $arrayProduct['starting_bid']);
// $stmt->bindParam(':current_bid', $arrayProduct['current_bid']);
// $stmt->bindParam(':image_url', $arrayProduct['image_url']);
// $stmt->bindParam(':end_time', $arrayProduct['end_time']);
// $biditem = new BidItem();
// $productData = ["user_id" => "1", "title" => "Bandai® Gunpla Real Grade 1/144 Model Kit RG-30 RG RX-0 FULL ARMOR UNICORN GUNDAM", "description" => "The Real Grade Full Armor Unicorn Gundam is armed to the teeth with its BeamMagnum, two HyperBazookas, Beam Javelin, and much more, including the pair of massive propellant tanks attached to its backpack! It snaps together for ease of assembly, and is molded in color so painting isn't necessary, although you could certainly add some paintwork to make it really stand out on your shelf.", "starting_bid" => 400, "current_bid" => 400, "image_url" => "https://da.lnwfile.com/_/da/_raw/ln/2w/v5.jpg", "end_time" => "2023-03-24 8:23:10"];
// $biditem->addProduct($productData);