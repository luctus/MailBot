<?php


/**
 * Base class that represents a query for the 'cuenta' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.5.3-dev on:
 *
 * Wed Aug  4 22:47:56 2010
 *
 * @method     CuentaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CuentaQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     CuentaQuery orderByCredential($order = Criteria::ASC) Order by the credential column
 *
 * @method     CuentaQuery groupById() Group by the id column
 * @method     CuentaQuery groupByUsername() Group by the username column
 * @method     CuentaQuery groupByCredential() Group by the credential column
 *
 * @method     CuentaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CuentaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CuentaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CuentaQuery leftJoinLog($relationAlias = '') Adds a LEFT JOIN clause to the query using the Log relation
 * @method     CuentaQuery rightJoinLog($relationAlias = '') Adds a RIGHT JOIN clause to the query using the Log relation
 * @method     CuentaQuery innerJoinLog($relationAlias = '') Adds a INNER JOIN clause to the query using the Log relation
 *
 * @method     Cuenta findOne(PropelPDO $con = null) Return the first Cuenta matching the query
 * @method     Cuenta findOneOrCreate(PropelPDO $con = null) Return the first Cuenta matching the query, or a new Cuenta object populated from the query conditions when no match is found
 *
 * @method     Cuenta findOneById(int $id) Return the first Cuenta filtered by the id column
 * @method     Cuenta findOneByUsername(string $username) Return the first Cuenta filtered by the username column
 * @method     Cuenta findOneByCredential(string $credential) Return the first Cuenta filtered by the credential column
 *
 * @method     array findById(int $id) Return Cuenta objects filtered by the id column
 * @method     array findByUsername(string $username) Return Cuenta objects filtered by the username column
 * @method     array findByCredential(string $credential) Return Cuenta objects filtered by the credential column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseCuentaQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseCuentaQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'Cuenta', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CuentaQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CuentaQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CuentaQuery) {
			return $criteria;
		}
		$query = new CuentaQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Cuenta|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CuentaPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{	
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    CuentaQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CuentaPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CuentaQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CuentaPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CuentaQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CuentaPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the username column
	 * 
	 * @param     string $username The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CuentaQuery The current query, for fluid interface
	 */
	public function filterByUsername($username = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($username)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $username)) {
				$username = str_replace('*', '%', $username);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CuentaPeer::USERNAME, $username, $comparison);
	}

	/**
	 * Filter the query on the credential column
	 * 
	 * @param     string $credential The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CuentaQuery The current query, for fluid interface
	 */
	public function filterByCredential($credential = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($credential)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $credential)) {
				$credential = str_replace('*', '%', $credential);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CuentaPeer::CREDENTIAL, $credential, $comparison);
	}

	/**
	 * Filter the query by a related Log object
	 *
	 * @param     Log $log  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CuentaQuery The current query, for fluid interface
	 */
	public function filterByLog($log, $comparison = null)
	{
		return $this
			->addUsingAlias(CuentaPeer::ID, $log->getCuentaId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Log relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CuentaQuery The current query, for fluid interface
	 */
	public function joinLog($relationAlias = '', $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Log');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Log');
		}
		
		return $this;
	}

	/**
	 * Use the Log relation Log object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    LogQuery A secondary query class using the current class as primary query
	 */
	public function useLogQuery($relationAlias = '', $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinLog($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Log', 'LogQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Cuenta $cuenta Object to remove from the list of results
	 *
	 * @return    CuentaQuery The current query, for fluid interface
	 */
	public function prune($cuenta = null)
	{
		if ($cuenta) {
			$this->addUsingAlias(CuentaPeer::ID, $cuenta->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCuentaQuery
