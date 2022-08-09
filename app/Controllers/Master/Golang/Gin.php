<?php

namespace App\Controllers\Master\Golang;

use App\Controllers\BaseController;
use App\Models\Console;

class Gin extends BaseController
{
	public function __construct()
	{
		$this->cmd = new Console();
	}
	public function controller()
	{
		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);

		echo 'package controllers

import (
	"errors"
	"net/http"
	"rest/config"
	"rest/models"
	"github.com/gin-gonic/gin"
	"gorm.io/gorm"
)';

		echo '&#13;';

		echo '
type ' . $table . 'Repo struct {
	Db *gorm.DB
}';

		echo '&#13;';

		echo '
func ' . ucfirst($table) . 'Controll() *' . $table . 'Repo {
	db := config.InitDb()
	db.AutoMigrate(&models.' . ucfirst($table) . '{})
	return &' . $table . 'Repo{Db: db}
}';
		echo '&#13;';
		////fungsi create
		echo 'func (repository *' . $table . 'Repo) Create' . $table . '(c *gin.Context) {
	var user models.' . ucfirst($table) . '

	if err := c.ShouldBindJSON(&user); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	models.Create' . $table . '(repository.Db, &user)
	c.JSON(http.StatusOK, gin.H{"data": user})

}';
		echo '&#13;';
		///fungsi getall
		echo 'func (repository *' . $table . 'Repo) Get' . $table . 's(c *gin.Context) {
	var user []models.' . ucfirst($table) . '
	err := models.Get' . $table . 's(repository.Db, &user)
	if err != nil {
		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.JSON(http.StatusOK, user)
}';
		echo '&#13;';

		//get user by id
		echo 'func (repository *' . $table . 'Repo) Get' . $table . '(c *gin.Context) {
	id, _ := c.Params.Get("id")
	var user models.' . ucfirst($table) . '
	err := models. Get' . $table . '(repository.Db, &user, id)
	if err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			c.AbortWithStatus(http.StatusNotFound)
			return
		}

		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.JSON(http.StatusOK, user)
}';

		echo '&#13;';

		// update user
		echo '
func (repository *' . $table . 'Repo) Update' . $table . '(c *gin.Context) {
	var user models.' . ucfirst($table) . '
	id, _ := c.Params.Get("id")
	err := models.Get' . $table . '(repository.Db, &user, id)
	if err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			c.AbortWithStatus(http.StatusNotFound)
			return
		}

		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.BindJSON(&user)
	err = models.Update' . $table . '(repository.Db, &user)
	if err != nil {
		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.JSON(http.StatusOK, user)
}';
		echo '&#13;';

		// delete user
		echo '
func (repository *' . $table . 'Repo) Delete' . $table . '(c *gin.Context) {
	var user models.' . ucfirst($table) . '
	id, _ := c.Params.Get("id")
	err := models.Delete' . $table . '(repository.Db, &user, id)
	if err != nil {
		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.JSON(http.StatusOK, gin.H{"message": "' . $table . ' deleted successfully"})
}';
	}

	public function routes()
	{

		$db = $this->request->getVar('db');
		$table = $this->request->getVar('table');
		$data['table'] = $table;
		$data['column'] = $this->cmd->show_column($db, $table);

		echo '' . $table . 'Repo := controllers.' . ucfirst($table) . 'Controll()
r.POST("/' . $table . '", auth, ' . $table . 'Repo.Create' . $table . ')
r.GET("/' . $table . '", auth, ' . $table . 'Repo.Get' . $table . 's)
r.GET("/' . $table . '/:id", auth, ' . $table . 'Repo.Get' . $table . ')
r.PUT("/' . $table . '/:id", auth, ' . $table . 'Repo.Update' . $table . ')
r.DELETE("/' . $table . '/:id", auth, ' . $table . 'Repo.Delete' . $table . ')';
	}
}
